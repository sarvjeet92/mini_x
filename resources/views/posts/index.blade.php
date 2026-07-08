<div>
    <!-- The whole future lies in uncertainty: live immediately. - Seneca -->


    
    @foreach ($data['results'] as $character)
        
        <div class="card"> 
            <h2>{{ $character['name']?? 'N/A' }}</h2>            
            <p>Age: {{ $character['age']?? 'N/A' }}</p>
            <p>Image: {{ $character['img']?? 'N/A' }}</p>
            <p>|{{ $character['img']?? 'N/A' }}|</p>
            <img src="{{ $character['img']?? 'N/A' }}" alt="Character Image" width="200" height="200">
            <p>Species: {{ $character['species'][0]?? 'N/A' }}</p>
            <p>Gender: {{ $character['gender']?? 'N/A' }}</p>
            <p>Height: {{ $character['height']?? 'N/A' }}</p> 
        </div>
        
    @endforeach
<img src="https://picsum.photos/200/300" alt="Test">
<img src="https://static.wikia.nocookie.net/shingekinokyojin/images/9/93/Armin_Arlelt_%28Anime%29_character_image.png/revision/latest/scale-to-width-down/350?cb=20210322005647"
     width="200">
</div>
