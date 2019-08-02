<?php
defined('TYPO3_MODE') or die();

call_user_func(function($extKey) {

	/** @var \TYPO3\CMS\Core\Resource\Rendering\RendererRegistry $rendererRegistry */
	$rendererRegistry = \TYPO3\CMS\Core\Resource\Rendering\RendererRegistry::getInstance();
	$rendererRegistry->registerRendererClass(
		\TheLine\Lottie\Resource\Rendering\LottieRenderer::class
	);
	unset($rendererRegistry);

	$GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext'] .= ',json';

}, $_EXTKEY);

