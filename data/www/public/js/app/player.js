define(
	['require', 'phaser', 'lodash', 'util/publisher', 'app/game'],
	function (require, Phaser, _, publisher, Game) { 
		'use strict';

		var localPub = publisher();
		var theGame = {};
		var theParent = {};

		function Player() {    
			console.log('initiating the Player');    
		}
		
		Player.prototype = {
			constructor: Player,
			hero: null,
			emitter: {},
			cursors: {},

			init: function(game, parent) {
				theParent = parent;
				theGame = game;
			},

			create: function() {
				this.hero = theGame.add.sprite(64, 400, 'player');
				publisher.publish('onReady.hero', this.hero);
				this.hero.anchor.set(0);

				this.cursors = theGame.input.keyboard.createCursorKeys();

				this.emitter = theGame.add.emitter(0, 0, 200);

				this.emitter.makeParticles('chunk');
				this.emitter.minRotation = 0;
				this.emitter.maxRotation = 0;
				this.emitter.gravity = 1000;
				this.emitter.bounce.setTo(0.5, 0.5);

				this.hero.reset(64, 400, 1);
			},

			jetPack: function() {
				this.emitter.x = this.hero.x + 5;
				this.emitter.y = this.hero.y + this.hero.height / 2;
				this.emitter.start(true, 2000, null, 1);
			},

			update: function() {
//theGame.debug.spriteInfo(this.hero,650,48);

				if(this.hero.body !== null) {
					this.hero.body.velocity.x = 0;
					this.hero.body.velocity.y = 0;					
				}
				if(this.cursors !== undefined) {
					if (this.cursors.left.isDown)
					{
						this.hero.body.velocity.x = -500;
						this.jetPack();
					} else if (this.cursors.right.isDown) {
						this.hero.body.velocity.x = 500;
						this.jetPack();
					}

					if (this.cursors.up.isDown)
					{
						this.hero.body.velocity.y = -350;
						theGame.camera.y -= 4;
				        this.jetPack();
				        // check if upper is a platform tile & power up jetpack & loose gas
				        // check if its a diagonal tile, if so move him accordingly up & side
					} else if (this.cursors.down.isDown) {
						this.hero.body.velocity.y = 350;
						theGame.camera.y += 4;
						// check if the hero is on the platform and dont jetpack then
				        this.jetPack();
					}
				}
			},
		};
		return Player;
	}
);