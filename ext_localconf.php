<?php
use TYPO3\CMS\Core\Resource\Rendering\RendererRegistry;
use RectorPrefix20220604\TYPO3\CMS\Core\Utility\GeneralUtility;
use TheLine\Lottie\Resource\Rendering\LottieRenderer;
defined('TYPO3') || die();

call_user_func(function() {

	/** @var RendererRegistry $rendererRegistry */
	$rendererRegistry = GeneralUtility::makeInstance(RendererRegistry::class);
	$rendererRegistry->registerRendererClass(
		LottieRenderer::class
	);
	unset($rendererRegistry);

	// Allow JSON files to be added to `tt_content.assets`,
	// which is only present in `textmedia` CType by default
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'] .= ',json';

});
