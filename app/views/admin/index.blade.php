<ul>
    <li>tagovi - tražilica (public)</li>
    <li>tagovi - poseban view / učestalost tagova (public)</li>
    <li>ispis svih vijesti - infinite scroll</li>
    <li>404, odkomentirat start/global i uredit view</li>
    <li>jQuery povećanje veličine slova na prikazu teksta za public dio</li>
    <li>RSS za vijesti</li>
    <li>kalendar natjecanja?</li>

    - lazy load na sve
    - dodaj captchu na mail
    - isotope nije responsive
    - css uredi po google pravilima
</ul>


   <!--  //update number of views - kod public pregleda vijesti
    $current_news = News::find($newsData->id);
    $current_news->increment('num_visited');
    $current_news->save();  //potrebno?
    $newsData->num_visited += 1;     //u sesssion? -->



