<layout.default>
  <article>
    <h1>hello at</h1>


    <p :foreach="articles as article">t <a :href="helper.path(article)">{{article.title}} {{article._id}}</a>
    </p>

    <sft.image src="src/pages/kitty.jpg" size="600x" alt="this is the cat"></sft.image>

    <caption>Foto von <a href="https://unsplash.com/de/@yerlinmatu?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Yerlin Matu</a>
      auf <a href="https://unsplash.com/de/fotos/flachfokusfotografie-von-weissen-und-braunen-katzen-GtwiBmtJvaU?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
    </caption>
  </article>


</layout.default>

<?php
$articles = $helper->query('*(_type=="article" && site._ref== "www.wasserturm-badsaarow.de")');
// helper.path(article._id)