# XDCC-simple

# What this xdcc list can do?
You can see what this website do by [watching the todo list](TODO.md)

## Why another XDCC Parser?

- Because [XDCCParser-global](https://github.com/nitmir/XDCCParser-global) is bugged
- Because [my fork](https://github.com/Kcchouette/XDCCParser) is less bugged, but isn't responsive (mobile) and use Text File from Iroffer (this project use XML file from Iroffer)

## Requirements:

- XML File from Iroffer (remove the `#` from `#xdccxmlfile mybot.xml` [here](https://github.com/dinoex/iroffer-dinoex/blob/master/sample.config#L108))
- PHP (I develop it using PHP7.0, so I think > 5.0 is ok)

## How to use it?

1. Edit the `data.json` file with: a name of your bot and a XML file. `[{"name": "BOT1","xml": "BOT1.xml"}]` for one bot; `[{"name": "BOT1","xml": "BOT1.xml"},{"name": "BOT2","xml": "BOT2.xml"}]` for 2 bots, etc.
2. Finish :)
