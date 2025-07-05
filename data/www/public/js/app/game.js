define(
	['require', 'phaser', 'lodash', 'util/publisher', 
	'app/world', 'app/player', 'app/items'], 
	function (require, Phaser, _, publisher, World, Player, Items) { 
		'use strict';

		var localPub = publisher();
		var kids = [];
		var world = new World();
		var player = new Player();
		var items = new Items();
		var sndFx = null;
		kids = [world, items, player];

		function Game() {    
			console.log('initiating the Game');    
		}
		
		Game.prototype = {
			constructor: Game,
			game: null,
			fpsText: null,

			init: function() {

				this.game = new Phaser.Game(960, 512, Phaser.AUTO, 'game', { 
					preload: this.preload, 
					create: this.create, 
					update: this.update 
				}, false, false);

				publisher.subscribe('onReady.coins', function (grp) {
					console.log('coins ready!');
					world.putCoins(grp);
				});
				publisher.subscribe('onReady.hero', function (spr) {
					console.log('hero ready!');
					world.putHero(spr);
				});

				_.forEach(kids, function(item){item.init(this.game, this)}, this);
			},

			preload: function() {
				this.game.load.tilemap('level', 'maps/level01.json', null, Phaser.Tilemap.TILED_JSON);

				this.game.load.image('tiles', 'img/Level01-20Taslar.png');
				this.game.load.image('player', 'img/char.png');
				this.game.load.image('chunk', 'img/chunk.png');
				this.game.load.spritesheet('money', 'img/coin.png', 32, 32, 6);
				this.game.load.audio('sfx', 'snd/clink_sound.mp3');
				this.game.load.binary('elysium', 'snd/elysium.mod');
//				this.game.load.script('protracker', '../plugins/ProTracker.js');
			},

			create: function() {
				_.forEach(kids, function(item){item.create()}, this);

/*				module = new Protracker();
			 	module.buffer = game.cache.getBinary('elysium');
				module.parse();
				module.play();*/

    			sndFx = this.game.add.audio('sfx');
				sndFx.addMarker('ping', 0, 1.0);
				world.putSounds(sndFx);
				this.game.world.setBounds(0, 0, 38400, 512);

				// Show FPS
				this.game.time.advancedTiming = true;
				this.fpsText = this.game.add.text(20, 20, '', {font: '16px Arial', fill: '#ffffff'});
			},

			update: function() {
				if (this.game.time.fps !== 0) {
					this.fpsText.setText(this.game.time.fps + ' FPS');
				}
				_.forEach(kids, function(item){item.update()}, this);
			},

		};
		return Game;
	}
);