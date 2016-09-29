# TODO

## For v0.2

 - [x] Import JSON files
 - [x] Export JSON files
 - [x] View to show Bookmarks from JSON
 - [x] ADD/REMOVE Bookmarks from JSON
 - [x] A Search input (to search on one BOT)
 - [x] A Search input (to search on all BOTs)
 - [x] Atom feed based on `adddate` tag
 - [x] Download a CSV file with the number of download for each bot

## For v0.3

 - [ ] Upload the XML file into cache (serialize it? download it?)
 - [ ] Cache can be refreshed (automatic check?)
 - [ ] Download the XML file (from URL)? into cache (use the `lastupdate` tag; an epoch time)
 - [ ] Possibility of reordering bots/bookmarks in the ADMIN page
 - [ ] Try to use the text file listing from iroffer
 - [x] Do a file that parse the cache boorkmark of XDCCParser-global to a json file
 - [ ] When adding bot, ask if Website/IRC are the same than the main in the ADMIN page

## For v0.4

 - [ ] **Try** to use the text file listing from iroffer
 - [ ] When adding bot, ask if Website/IRC are the same than the main in the ADMIN page

## Improvement

 - [ ] list for bot name (instead of a simple echo + br)?


## Idea

 - [ ] Display for example 50 number of file, else use a pagination? (cf datatables)
 - [ ] Use Nick from xdcc list? # what in case multi-nick?
 - [ ] Display if the bot support @find (and how many ?) # config of bot
 - [ ] Possibility to edit the config.php online
 - [ ] Choose the IRC adress by using a list of network provided by the ``network` tag
 - [ ] Select bot for bookmark with a select
 - [ ] Choose the XML file location using a select tag in the ADMIN page if not using URL
 - [ ] Allow to cache PHP file?