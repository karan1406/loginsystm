<x-layout>
<header>
    <x-navbar/>
</header>
<aside>
    <x-sidebar/>
</aside>


<section class="content-wrapper">
    <div class="row container">
    <x-card.card total="150" text="My First text" bgcolor="bg-info" title="My First title" />
    <x-card.card total="200" text="My Second text" bgcolor="bg-danger" title="My Second title" />

    </div>
    <div class="row container">
        <x-card.sm-card bgcolor="bg-info" text="My Firts Text" price="15000" description="This is my first text"/>
        <x-card.sm-card bgcolor="bg-danger" text="My Second Text" price="15000" description="This is my second text"/>

    </div>
</section>
<x-footer/>
</x-layout>
