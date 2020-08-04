<?php
defined('TYPO3_MODE') or die();

call_user_func(function($extKey) {

	/** @var \TYPO3\CMS\Core\Resource\Rendering\RendererRegistry $rendererRegistry */
	$rendererRegistry = \TYPO3\CMS\Core\Resource\Rendering\RendererRegistry::getInstance();
	$rendererRegistry->registerRendererClass(
		\TheLine\Lottie\Resource\Rendering\LottieRenderer::class
	);
	unset($rendererRegistry);

	// Allow JSON files to be added to `tt_content.assets`,
	// which is only present in `textmedia` CType by default
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'] .= ',json';

}, $_EXTKEY);

