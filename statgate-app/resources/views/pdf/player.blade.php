@php
  $p = $player['data']['response'];
@endphp
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Player CV</title>

    <style>
      .pdf-title{
        text-align: center;
      }
      .data-container{
        /* margin-left: 15%; */
      }
    </style>
  </head>
  <body>
    <div id="pdf-container">
      <h1 class="pdf-title">Albion player CV</h1>
      <div class="data-container">
        <span>Name: </span>
        <span>{{ $p['Name'] }}</span>
      </div>
      <div class="data-container">
        <span>Guild: </span>
        <span>{{ $p['GuildName'] }}</span>
      </div>
    </div>
  </body>
</html>