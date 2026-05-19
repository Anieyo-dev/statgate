<x-filament-panels::layout>
  <div class="flex mt-8 text-white albion-frame--1 flex-col lg:flex-row">
      <div id="albion-search-container">
        <div id="albion-search-form">
          <livewire:albion-guild-search />
        </div>
        <div id="albion-search-cache">

        </div>
      </div>
      <div id="albion-search-result-container" class="ml-6">
        <div id="albion-result-box">
          <h1 id="albion-result-title" class="text-3xl font-bold text-gray-100 mb-3 tracking-wide">
              Find Your Next Guild
          </h1>
          
          <p id="albion-result-desc" class="text-gray-400 text-base leading-relaxed mb-6">
              Search through Albion Online guilds across all servers. Check their stats, members, and alliance details to find the perfect match for your playstyle.
          </p>
          <div id="albion-guild-card">
            <livewire:components.albion-guild-card />
          </div>
        </div>
      </div>
      <div id="albion-popular-guilds-container">
        <div id="guilds-box">
          <div id="guild-card">

          </div>
        </div>
      </div>
  </div>
</x-filament-panels::layout>