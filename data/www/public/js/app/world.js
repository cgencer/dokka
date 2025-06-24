define(
	['require', 'phaser', 'lodash', 'util/publisher', 'app/game'],
	function (require, Phaser, _, publisher, Game) { 
		'use strict';

		var localPub = publisher();
		var theGame = {};
		var theParent = {};

		function World() {    
			console.log('initiating the World');    
		}
		
		World.prototype = {
			constructor: World,
			hero: null,
			sndFx: null,
			coins: null,
			collisionLayer: null,
			map: null,
			partial: null,
			layerBack: null,
			layerPlatforms: null,
			grpPlatforms: null,
			colFlags: {
				coins: false,
				hero: false,
				back: false
			},

			init: function(game, parent) {
				theGame = game;
				theParent = parent;
			},

			putSounds: function(snd) {
				this.sndFx = snd;
			},

			putCoins: function(spr) {
				this.coins = spr;
				theGame.physics.enable(this.coins, Phaser.Physics.ARCADE);
				this.colFlags.coins = true;
			},

			putHero: function(spr) {
				this.hero = spr;
				theGame.physics.enable(this.hero, Phaser.Physics.ARCADE);
				this.hero.body.gravity.y = 5000;
				this.hero.body.collideWorldBounds = true;
				this.colFlags.hero = true;
			},

			create: function() {
				this.map = theGame.add.tilemap('level');
				theGame.physics.arcade.TILE_BIAS = 40;
				this.map.addTilesetImage('Level01-20Taslar', 'tiles');

				this.layerBack = this.map.createLayer('back');
				this.colFlags.back = true;

				var layerWindows = this.map.createLayer('windows');

				this.layerPlatforms = this.map.createLayer('platforms');
				theGame.physics.enable(this.layerPlatforms, Phaser.Physics.ARCADE);
				this.layerPlatforms.enableBody = true;
				this.layerPlatforms.enable = true;

				this.map.setCollisionBetween(41, 56, true, 'back');
				this.map.setCollisionBetween(58, 74, true, 'back');
				this.map.setCollisionBetween(76, 96, true, 'back');
				this.map.setCollisionBetween(100, 115, true, 'back');
				this.map.setCollisionBetween(121, 150, true, 'back');

				this.map.setCollisionBetween(41, 56, true, 'platforms');
				this.map.setCollisionBetween(58, 74, true, 'platforms');
				this.map.setCollisionBetween(76, 96, true, 'platforms');
				this.map.setCollisionBetween(100, 115, true, 'platforms');
				this.map.setCollisionBetween(121, 150, true, 'platforms');

				this.map.setCollisionBetween(41, 56, true, 'windows');
				this.map.setCollisionBetween(58, 74, true, 'windows');
				this.map.setCollisionBetween(76, 96, true, 'windows');
				this.map.setCollisionBetween(100, 115, true, 'windows');
				this.map.setCollisionBetween(121, 150, true, 'windows');
			},

			update: function() {

/*theGame.debug.spriteBounds(this.hero, 'rgb(255,0,0)', false);
theGame.debug.bodyInfo(this.hero, 552, 66, 'rgb(0,0,0)');
theGame.debug.bodyInfo(this.hero, 550, 64, 'rgb(200,0,0)');
*/
				theGame.camera.follow(this.hero);

				if(this.colFlags.hero) {
					theGame.physics.arcade.collide(this.hero, this.layerPlatforms, function(h, p) {
console.log(p.index);
						if(p.index == 62 || p.index == 66){
							// to the left
							h.x -= 2;
						}else if(p.index == 63 || p.index == 67){
							// to the right
							h.x += 2;
						}
					}, null);
				}
				if(this.colFlags.coins) {
					theGame.physics.arcade.overlap(this.hero, this.coins, function(h, c) {
						if(this.sndFx) this.sndFx.play('ping');
						c.kill();
					}, null);
				}
				if(this.colFlags.back && this.colFlags.hero) {
					theGame.physics.arcade.overlap(this.hero, this.layerBack, function(h, l){
					});
				}
			},
		};
		return World;
	}
);