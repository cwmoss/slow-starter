<?php

use plugin\slowhand\loader;
use slowfoot\configuration;
use slowfoot\image\profile;
use slowfoot\loader\json;

use slowfoot_plugin\markdown;
use slowfoot_plugin\phuety\phuety_adapter;
use slowfoot_plugin\slowhand;



$sh = new slowhand\slowhand('http://localhost:8002', 'website', $_ENV['SLOWHAND_ADMIN_SECRET'] ?? $_SERVER['SLOWHAND_ADMIN_SECRET']);

return new configuration(
  site_name: "I ❤️ my cat",

  sources: [
    "cms" => $sh->get_loader('q(_type=="page" || _type=="article" || _type=="site")', function ($doc) {
      if ($doc['slug']['current'] ?? false) {
        $doc['slug'] = $doc['slug']['current'];
      } else {
        $doc['slug'] = $doc['_id'];
      }
      return $doc;
    }),
    //  'chapter_index' => site::load_chapter_index(...)
  ],

  templates: [
    'article' => '/:site._ref/:slug',
  ],

  plugins: [
    //  new site(),
    new markdown\markdown_plugin(),
    $sh
  ],

  template_engine: phuety_adapter::class,
  // build: "../docs"
  hooks: [
    /*    "after_build" => function () {
        $dist = __DIR__ . "/dist/";
        $docs = __DIR__ . "/../docs/";
        `rsync -avz --delete $dist $docs`;
    }
        */]
);
