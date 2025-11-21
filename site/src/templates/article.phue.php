<layout.default>
    <article>
        <h1>{{ page.title }}</h1>

        <sft.markdown :body="page.text"></sft.markdown>

        <time :if="page._createdAt">{{date}}</time>
    </article>
</layout.default>

<?php

use DateTime;

if ($props->page->_createdAt) $date = new DateTime($props->page->_createdAt)->format("d.m");
