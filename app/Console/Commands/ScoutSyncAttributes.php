<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Scout\EngineManager;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScoutSyncAttributes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scout:syncAttributes {model?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync your configuration with Meilisearch';

    /**
     * The Meilisearch client.
     *
     * @var \Meilisearch\Client
     */
    private $client;

    /**
     * Sync the attributes of the given model(s).
     * @var string
     */
    private $settingsName = 'scoutSyncAttributes';

    /**
     * Default model to sync attributes.
     * @var array
     */
    private $settings = [];

    /**
     * Namespace for the current model
     *
     * @return void
     */
    private $namespace;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = app(EngineManager::class)->driver('meilisearch');
    }

    /**
     * Execute the console command.
     *
     * void
     */
    public function handle(): void
    {
        if ($this->namespace = $this->argument('model')) {
            $model = new $this->namespace;
            $this->syncModel($model);
            return;
        }

        $this->syncAll();
    }

    /**
     * Sync model attributes.
     *
     * void
     */
    private function syncModel($model): void
    {
        if ($this->isSearchable($model)) {
            $this->setSettings($model);
            $this->applyId();
            $this->applyTimeStamps($model);
            $this->applySoftDelete($model);
            $this->updateIndexSettings($model);
            $this->cleanSettings();
        }
    }

    /**
     * Set settings from model.
     *
     * void
     */
    private function setSettings($model): void
    {
        if ($this->hasSettings($model)) {
            $this->settings = $model->{$this->settingsName};
        }
    }

    /**
     * Sync all models.
     *
     * void
     */
    private function syncAll(): void
    {
        collect(scandir(app_path('Models')))->each(
            function ($path) {
                if ($path === '.' || $path === '..' || $path === 'Traits') {
                    return true;
                }

                $this->namespace = 'App\Models\\' . substr($path, 0, -4);
                $model = new $this->namespace;
                $this->syncModel($model);
            }
        );
    }

    /**
     * Update index settings.
     *
     * void
     */
    private function updateIndexSettings($model): void
    {
        $index = $this->client->index($model->searchableAs());
        collect($this->settings)->each(
            function ($value, $key) use ($index) {
                $status = $index->{$key}($value);
                $jsonStatus = json_encode($status);
                $this->line("[{$this->namespace}] {$key} has been updated: {$jsonStatus}");
            }
        );
    }

    /**
     * Clean settings.
     *
     * void
     */
    private function cleanSettings(): void
    {
        $this->settings = [];
    }

    private function hasTimeStamps($model): bool
    {
        return $model->timestamps;
    }

    /**
     * Apply id field as sortable attribute.
     *
     * void
     */
    private function applyId(): void
    {
        $updateSortableAttributes = ['id'];
        if (array_key_exists('updateSortableAttributes', $this->settings)) {
            $updateSortableAttributes = array_merge(
                $updateSortableAttributes,
                $this->settings['updateSortableAttributes']
            );
        }

        $this->settings['updateSortableAttributes'] = $updateSortableAttributes;
    }

    /**
     * Apply timestamps fields as sortable attributes.
     *
     * void
     */
    private function applyTimeStamps($model): void
    {
        if ($this->hasTimeStamps($model)) {
            $updateSortableAttributes = ['created_at', 'updated_at'];
            if (array_key_exists('updateSortableAttributes', $this->settings)) {
                $updateSortableAttributes = array_merge(
                    $updateSortableAttributes,
                    $this->settings['updateSortableAttributes']
                );
            }
            $this->settings['updateSortableAttributes'] = $updateSortableAttributes;
        }
    }

    /**
     * Check if model has soft delete.
     *
     * void
     */
    private function hasSoftDelete($model): bool
    {
        return in_array(SoftDeletes::class, class_uses($model));
    }

    /**
     * Apply soft delete field as filterable attribute.
     *
     * void
     */
    private function applySoftDelete($model): void
    {
        if ($this->hasSoftDelete($model)) {
            $updateFilterableAttributes = ['__soft_deleted'];
            if (array_key_exists('updateFilterableAttributes', $this->settings)) {
                $updateFilterableAttributes = array_merge(
                    $updateFilterableAttributes,
                    $this->settings['updateFilterableAttributes']
                );
            }
            $this->settings['updateFilterableAttributes'] = $updateFilterableAttributes;
        }
    }

    /**
     * Check if model has settings property.
     *
     * void
     */
    private function hasSettings($model): bool
    {
        return property_exists($model, $this->settingsName);
    }

    /**
     * Check if model is searchable.
     *
     * void
     */
    private function isSearchable($model): bool
    {
        return in_array(Searchable::class, class_uses($model));
    }

}
