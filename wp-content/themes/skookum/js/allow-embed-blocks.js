wp.domReady(function () {
	const allowedEmbedBlocks = [
        '', // allow none so only the embed block shows which works for youtube and vimeo.
	];

	wp.blocks.getBlockVariations('core/embed').forEach(function (blockVariation) {
		if (-1 === allowedEmbedBlocks.indexOf(blockVariation.name)) {
			wp.blocks.unregisterBlockVariation('core/embed', blockVariation.name);
		}
	});
});