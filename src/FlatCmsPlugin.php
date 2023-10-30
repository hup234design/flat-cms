<?php

namespace Hup234design\FlatCms;

use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\Contracts\Plugin;
use Illuminate\Support\Facades\DB;

class FlatCmsPlugin implements Plugin
{

    public function getId(): string
    {
        return 'filament-cms';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $resources = [
            //
        ];

//        $conditionalResources = [
//            'services' => [
//                ServiceResource::class,
//                ServiceCategoryResource::class,
//            ],
//            'events' => [
//                EventResource::class,
//                EventCategoryResource::class,
//            ],
//            'projects' => [
//                ProjectResource::class,
//                ProjectCategoryResource::class,
//            ],
//            'testimonials' => [
//                TestimonialResource::class,
//            ]
//        ];
//
//        foreach ($conditionalResources as $configKey => $resourceNames) {
//            if (config('cms.' . $configKey, false)) {
//                $resources = array_merge($resources, $resourceNames);
//            }
//        }

        $panel
            ->navigationGroups([
                'Content',
                'Media',
                'Categories',
                'Site Management',
            ])
//            ->navigationGroups([
//                NavigationGroup::make()
//                    ->label('Pages')
//                    ->icon('heroicon-o-document-text')
//                    ->collapsed(),
//                NavigationGroup::make()
//                    ->label('Posts')
//                    ->icon('heroicon-o-newspaper')
//                    ->collapsed(),
//                NavigationGroup::make()
//                    ->label('Events')
//                    ->icon('heroicon-o-calendar-days')
//                    ->collapsed(),
//                NavigationGroup::make()
//                    ->label('Services')
//                    ->icon('heroicon-o-rectangle-stack')
//                    ->collapsed(),
//                NavigationGroup::make()
//                    ->label('Projects')
//                    ->icon('heroicon-o-rectangle-stack')
//                    ->collapsed(),
//                NavigationGroup::make()
//                    ->label('Media')
//                    ->icon('heroicon-o-photo')
//                    ->collapsed(),
////                NavigationGroup::make()
////                    ->label('Enquiries')
////                    ->icon('heroicon-o-inbox')
////                    ->collapsed(),
////                NavigationGroup::make()
////                    ->label('Site Management')
////                    ->icon('heroicon-o-cog-8-tooth')
////                    ->collapsed()
//            ])
            ->resources($resources)
            ->pages([
                //
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('View Site')
                    ->url('/')
                    ->openUrlInNewTab(true)
                    ->icon('heroicon-o-home'),
            ])
            ->maxContentWidth('full')
            ->plugins([
//                FilamentNavigation::make()
//                    ->itemType('Home',[])
//                    ->itemType('Page', [
//                        Select::make('id')
//                            ->options(function () {
//                                return DB::table('pages')
//                                    ->where('home', false)
//                                    ->pluck('title', 'id');
//                            })
//                    ])
//                    ->itemType('Index Page', [
//                        Select::make('Page')
//                            ->options(function () {
//                                return DB::table('index_pages')
//                                    ->pluck('title', 'id');
//                            })
//                    ])
//                    ->itemType('Dropdown', []),
//                FilamentPeekPlugin::make(),
            ]);
//            ->sidebarCollapsibleOnDesktop(true)
//            ->maxContentWidth('full');
    }

    public function boot(Panel $panel): void
    {
//        NavigationResource::navigationGroup('Site Management');
//        NavigationResource::navigationSort(2);
    }

    public static function get(): Plugin | \Filament\FilamentManager
    {
        return filament(app(static::class)->getId());
    }

}
