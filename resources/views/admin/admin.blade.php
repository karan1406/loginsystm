<x-layout>
<header>
    <x-navbar/>
</header>
<aside>
    <x-sidebar/>
</aside>


<section class="content-wrapper">
    <div class="row container">
    <x-card.card total="{{count($posts)}}" text="Post" bgcolor="bg-info" title="Post" />
    <x-card.card total="{{count($comments)}}" text="Comment" bgcolor="bg-danger" title="Comment" />

    </div>

</section>
<x-footer/>
</x-layout>
