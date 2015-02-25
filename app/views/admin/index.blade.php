<ul>
    <li>tagovi - tražilica (public)</li>
    <li>tagovi - poseban view / učestalost tagova (public)</li>
    <li>ispis svih vijesti - infinite scroll</li>
    <li>404, odkomentirat start/global i uredit view</li>
</ul>


   <!--  //update number of views - kod public pregleda vijesti
    $current_news = News::find($newsData->id);
    $current_news->increment('num_visited');
    $current_news->save();  //potrebno?
    $newsData->num_visited += 1;     //u sesssion? -->



