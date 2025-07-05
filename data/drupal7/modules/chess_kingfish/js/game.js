(function (root, factory) {
	if (typeof define === 'function' && define.amd) {
		define([], factory);
	} else if (typeof module === 'object' && module.exports) {
		module.exports = factory();
	} else {
		root.returnExports = factory();
	}
}(typeof self !== 'undefined' ? self : this, function () {
	return {};
}));
(function (w, d, $) {

	var saveData = {
		branchFens: []	
	};


	saveData.branchFens = [{index: lg[0].index, data: Base64.encode(lg[0].fen)}];


}(window, document, jQuery));
