# WBB plugin: TeamSpeak3 UserPanel Menü

This is the source code to the plugin available at the WoltLab plugin store: [TeamSpeak3 UserPanel Menü](https://pluginstore.woltlab.com/file/2229-teamspeak3-userpanel-men%C3%BC/)


## Development

Feel free to contribute! If you have built upon this plugin and want to share it with others, just create a pull request and I'm happy to submit it to the [WBB plugin store](https://pluginstore.woltlab.com/).

Since the plugin is OpenSource you are free to do as you want. However, I would prefer if we don't push various variants of the same plugin into the plugin store and instead add a newer version to the existing plugin.

### Build the plugin yourself

The structure of a WBB plugin is quite easy and building can be done manually in a few steps.
To make it even easier, this repo contains a gulp build to create a distribution which is ready to install.

It's a npm project, so install that if you don't have it yet. Run `npm install` once so the required modules are downloaded.
Now you just call `gulp dist` and it packages you all files into the dist folder `dist/ch.nana.usermenu.ts3.tar`

