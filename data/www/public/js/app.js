(function () {
	'use strict';


	requirejs.config({
		config: {
			'Facebook': {
				'appId'         : 'APP_ID',
				'channelUrl'    : 'CHANNEL_URL',
				'autoResize'    : false ,
				'status'        : true,
				'cookie'        : true,
				'xfbml'         : true,
			}
		},

		baseUrl: 'js/',
		paths: {
			'app': 'app',
			'util': 'util',

			'phaser': 'components/phaser-official/build/phaser.min',
			'lodash': 'components/lodash/dist/lodash.underscore.min',
		},

        shim: {
        	'phaser': {
        		exports: 'Phaser'
        	},
        },
		urlArgs: "bust=" +  (new Date()).getTime()
	});


	require(
		['phaser', 'lodash', 'app/game'], 
		function (Phaser, _, Game) {

			var theGame = new Game();
			theGame.init();
		}
	);
}());
