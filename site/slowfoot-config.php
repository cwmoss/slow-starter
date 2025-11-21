<?php

use plugin\slowhand\loader;
use slowfoot\configuration;
use slowfoot\image\profile;
use slowfoot\loader\json;

use slowfoot_plugin\markdown;
use slowfoot_plugin\phuety\phuety_adapter;

return new configuration(
  site_name: "I ❤️ my cat",

  sources: [
    "cms" => new loader('q(_type=="page" || _type=="article" || _type=="site")'),
    //  'chapter_index' => site::load_chapter_index(...)
  ],

  templates: [
    'article' => '/:site._ref/:_id',
  ],

  plugins: [
    //  new site(),
    new markdown\markdown_plugin(),
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
