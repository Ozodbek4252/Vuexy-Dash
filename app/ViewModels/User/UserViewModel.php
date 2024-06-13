<?php

declare(strict_types=1);

namespace App\ViewModels\User;

use App\ViewModels\BaseViewModel;
use Illuminate\Support\Collection;

class UserViewModel extends BaseViewModel
{
    public int $id;
    public $main_images;
    public $secondary_images;
    public ?array $stat;

    public array $translations;

    protected function populate(): void
    {
        $this->id = $this->_data->id;

        if (!empty($this->_data->aboutImages)) {
            $imageTypes = collect($this->_data->aboutImages)->groupBy('type')->map(function ($image) {
                return $image->map(function ($item) {
                    return $item->image;
                });
            });
        };

        collect($imageTypes)->map(function ($images, $type) {
            $type = $type . '_images';

            $this->$type = collect($images)->map(function ($image) {
                return ['image_' . $image->type => $image->full_path];
            })->toArray();
        });

        $this->main_images = array_reduce($this->main_images, function ($carry, $item) {
            return $carry + $item;
        }, []);
        $this->main_images['image'] = $this->main_images['image_medium'] ?? $this->main_images['image_original'] ?? $this->main_images['image_thumbnail'] ?? null;

        if ($this->secondary_images) {
            $this->secondary_images = array_reduce($this->secondary_images, function ($carry, $item) {
                return $carry + $item;
            }, []);
            $this->secondary_images['image'] = $this->secondary_images['image_medium'] ?? $this->secondary_images['image_original'] ?? $this->secondary_images['image_thumbnail'] ?? null;
        }


        $stat = $this->_data->stats;

        $stat = collect($stat)->groupBy(function ($item) {
            return $item->translations->first()->lang_id;
        });

        $stat = collect($stat)->map(function ($item) {
            return collect($item)->map(function ($stat) {
                return [
                    'id' => $stat['id'],
                    'title' => $stat['translations'][0]->content,
                    'value' => $stat['value'],
                    'lang' => $stat['translations'][0]->lang->code
                ];
            });
        })->toArray();

        $this->stat = collect($stat)->flatMap(function ($items) {
            return collect($items)->groupBy('lang')->map(function ($group) {
                return collect($group)->map(function ($item) {
                    return [
                        'id' => $item['id'],
                        "title" => $item["title"],
                        "value" => $item["value"]
                    ];
                })->toArray();
            });
        })->toArray();

        $this->translations = $this->getTranslations($this->_data->translations);
    }

    /**
     * Get translations from a collection.
     *
     * @param \Illuminate\Support\Collection $collection
     * @return array
     */
    private function getTranslations(Collection $collection): array
    {
        // Group the collection by language code
        $groupedByLang = $collection->groupBy(function ($item) {
            return $item->lang->code;
        });

        // Map each group to group by column name and return only the first item
        $mapped = $groupedByLang->map(function ($group) {
            return $group->groupBy('column_name')->map->first();
        });

        // Convert the mapped collection to array
        return $mapped->toArray();
    }
}
