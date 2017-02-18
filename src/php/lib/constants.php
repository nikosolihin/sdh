<?php
define( 'GOOGLE_PHOTOS_BROWSER_USER_ID', '107438708882698947040' );

// Google Calendar API Key
define( 'CALENDAR_API_KEY', 'AIzaSyCcqne1WUPeDEbyBfk9jurNKJ5ofAZlLIY' );

// Define different calendar IDs depending on locale
switch (get_locale()) {
  case "en_US":
    define( 'CALENDAR_ID', 'sdh.webteam@gmail.com' );
    break;
  case "id_ID":
    define( 'CALENDAR_ID', '874vlvhsbleibnjn6mr9i0pr0c@group.calendar.google.com' );
    break;
  default:
    define( 'CALENDAR_ID', 'sdh.webteam@gmail.com' );
}
