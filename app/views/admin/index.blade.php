<ul>
    <li>tagovi - tražilica (public)</li>
    <li>tagovi - poseban view / učestalost tagova (public)</li>
    <li>ispis svih vijesti - infinite scroll</li>
    <li>404, odkomentirat start/global i uredit view</li>
    <li>lazy load slika dodat</li>
</ul>


   <!--  //update number of views - kod public pregleda vijesti
    $current_news = News::find($newsData->id);
    $current_news->num_visited = $newsData->num_visited + 1;
    $current_news->save();
    $newsData->num_visited += 1; -->



