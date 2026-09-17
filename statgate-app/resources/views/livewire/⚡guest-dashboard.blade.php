<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="pt-2 text-gray-300 text-center">

    <h1 class="text-3xl font-extrabold my-12 text-[var(--font-albion-secondary-light)]">Everything at one place!</h1>

    <x-sections.dashboard-section 
        description="Track your progress"
        image="{{asset('images/slides/dashboard/albion-char.jpeg')}}"
        image_pos="xl:flex-row"
        redirect="{{ route('guest.search-player') }}">

    </x-sections.dashboard-section>

    <x-sections.dashboard-section 
        description="Track a wide long analisys of your albion journey!"
        image="{{asset('images/slides/dashboard/albion-guild.jpeg')}}"
        image_pos="xl:flex-row-reverse"
        section_class="my-12">

    </x-sections.dashboard-section>
    
    <x-sections.dashboard-section 
        description="Generate your CV for guilds as PDF file or Discord push"
        image="{{asset('images/slides/dashboard/albion-slide.jpeg')}}"
        image_pos="xl:flex-row"
        section_class="my-12">

    </x-sections.dashboard-section>

    <x-sections.dashboard-section 
        description="Track your guild progress and your members"
        image="{{asset('images/slides/dashboard/albion-slide-2.jpg')}}"
        image_pos=""
        section_class="my-12"
        redirect="{{ route('guest.guilds') }}">

    </x-sections.dashboard-section>

    
</div>