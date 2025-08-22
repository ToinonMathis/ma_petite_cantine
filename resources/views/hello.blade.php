<h1> Bonjour {{ $name }} ! voici votre menu </h1>

<ul>
    @foreach($menus as $menu)
        <li>
            {{ $menu->starter }} - {{ $menu->main_course }} - {{ $menu->dairy }} - {{ $menu->dessert }}
        </li>
    @endforeach
</ul>
