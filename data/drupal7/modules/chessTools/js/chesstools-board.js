/**
 * @file
 */
(function ($) {
  Drupal.behaviors.chesstoolsBoard = {
    attach: function (context, settings) {
      Drupal.chesstools = Drupal.chesstools || {};
      var path = settings.basePath + 'sites/all/modules/chesstools/img/chesspieces/wikipedia/{piece}.png';

      // Initiate
      $('.chesstools-board-wrapper').not('.ctb-processed').each(function() {
        var $wrapper = $(this);
        var id = $(this).data('fid'); // fid of pgn file
        var moves = Drupal.settings.chesstools.board[id].length;
        $wrapper.data('moves', moves)
            .data('currentMove', 0);
        var positionStart = Drupal.settings.chesstools.board[id][0].fen;
        positionStart = stripBackSlashes(positionStart);
        var cfg = {
          pieceTheme: path,
          position: positionStart
        };
        $('#board', context).attr('id', 'chesstools-board-' + id);
        Drupal.chesstools[id] = new ChessBoard('chesstools-board-' + id, cfg);

        // Add event listeners for the pager
        $('.pager a', $wrapper).click(function(e) {
          //var moves = $wrapper.data('moves');
          var currentMove = $wrapper.data('currentMove');
          console.log($(this).attr('class'));
          console.log(moves);
          console.log(currentMove);
          if ($(this).hasClass('first')) {
            if ( currentMove > 0 ) {
              var nextMove = 0;
            }
          }
          else if ($(this).hasClass('previous')) {
            if ( currentMove > 0 ) {
              var nextMove = currentMove - 1;
            }
          }
          else if ($(this).hasClass('next')) {
            if ( currentMove < moves -1 ) {
              var nextMove = currentMove + 1;
            }
          }
          else if ($(this).hasClass('last')) {
            if ( currentMove < moves -1 ) {
              var nextMove = moves -1;
            }
          }
          if (nextMove != undefined) {
            $wrapper.data('currentMove', nextMove);
            Drupal.chesstools[id].position(Drupal.settings.chesstools.board[id][nextMove].fen);
          }
        });

        // Add event listeners for the moves
        $('.algebraic', $wrapper).click(function() {
          var currentMove = $wrapper.data('currentMove');
          var nextMove = $(this).attr('data-move-number');
          if (currentMove != nextMove) {
            Drupal.chesstools[id].position(Drupal.settings.chesstools.board[id][nextMove].fen);
          }
        });

        $wrapper.addClass('ctb-processed');
      });
    }
  };
})(jQuery);

function stripBackSlashes(str) {
  return (str + '')
      .replace(/\\/g, '');
}
