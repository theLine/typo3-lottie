<?php

/*
 * This file is part of the "lottie" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the LICENSE file
 * that was distributed with this source code.
 * (c) 2019-2020
 */

namespace TheLine\Lottie\Resource\Rendering;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;
use TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder;

class LottieRenderer implements \TYPO3\CMS\Core\Resource\Rendering\FileRendererInterface {

	/** @var array List of options that will be passed to the HTML output */
	protected static $keepOptionsAsAttributes = [
		'class',
		'dir',
		'id',
		'lang',
		'style',
		'title',
		'accesskey',
		'tabindex',
		'onclick',
		'alt',
	];

	/**
	 * Returns the priority of the renderer.
	 * This way it is possible to define/overrule a renderer
	 * for a specific file type/context.
	 *
	 * For example create a video renderer for a certain storage/driver type.
	 *
	 * Should be between 1 and 100, 100 is more important than 1.
	 *
	 * @return int
	 */
	public function getPriority() {
		return 10;
	}

	/**
	 * Check if given File(Reference) can be rendered.
	 *
	 * @param FileInterface $file File or FileReference to render
	 * @return bool
	 */
	public function canRender(FileInterface $file) {
		$file = $file instanceof FileReference
			? $file->getOriginalFile()
			: $file
		;
		return
			$file->getExtension() === 'json'
			&& $file->getProperty('tx_lottie_is_lottie_animation')
		;
	}

	/**
	 * Render for given File(Reference) HTML output.
	 *
	 * @param FileInterface $file
	 * @param int|string $width TYPO3 known format; examples: 220, 200m or 200c
	 * @param int|string $height TYPO3 known format; examples: 220, 200m or 200c
	 * @param array $options
	 * @param bool $usedPathsRelativeToCurrentScript See $file->getPublicUrl()
	 * @return string
	 */
	public function render(
		FileInterface $file,
		$width,
		$height,
		array $options = [],
		$usedPathsRelativeToCurrentScript = false
	) {

		/** @var TagBuilder $container */
		$containerTag = new TagBuilder('div');
		/** @var TagBuilder $lottie */
		$lottieTag = new TagBuilder('div');

		// It may be useful to know if $file was a File or FileReference.
		$instanceType = '';
		switch (get_class($file)) {
			case File::class:
				$instanceType = 'File';
			break;
			case FileReference::class:
				$instanceType = 'FileReference';
			break;
		}

		$width = (int)$width;
		$height = (int)$height;

		// If no valid dimensions were provided
		// let's try to read the dimensions from the Lottie animation itself.
		if ($width === 0 || $height === 0) {
			$localProcessingFile = file_get_contents($file->getForLocalProcessing(false));
			$fileData = json_decode($localProcessingFile);

			if (isset($fileData->w)) {
				$width = (int)$fileData->w;
			}
			if (isset($fileData->h)) {
				$height = (int)$fileData->h;
			}
			unset($fileData);
			unset($localProcessingFile);
		}


		foreach ($options as $attributeName => $attributeValue) {
			if (in_array($attributeName, static::$keepOptionsAsAttributes) && ! empty($attributeValue)) {
				$lottieTag->addAttribute($attributeName, $attributeValue);
			}
		}


		// Make sure that the required "lottie" class will be added
		$class = $lottieTag->getAttribute('class') ?? '';
		$lottieTag->addAttribute('class', trim($class . ' lottie'));

		$containerTag->addAttribute('class', 'lottie-container');


		// If the width and height could be properly determined, add some
		// inline styling to preserve the required space to prevent
		// visual content shifts.
		// This could be rewritten more nicely for TYPO3 CMS v10,
		// but to maintain backwards compatibility let's keep it like
		// this for now.
		if ($width > 0 && $height > 0) {
			$containerTag->addAttribute(
				'style',
				sprintf(
					'position:relative;overflow:hidden;padding-top:%g%%',
					($height / $width) * 100
				)
			);
			$lottieTag->addAttribute(
				'style',
				'position:absolute;top:0;left:0;width:100%;height:100%'
			);
		}


		// If the public URL is not an absolute URL or not starting with a slash
		// let's put a slash in front of the URL.
		$publicUrl = $file->getPublicUrl($usedPathsRelativeToCurrentScript);
		if (! preg_match('#^(https?://|/)#', $publicUrl)) {
			$publicUrl = '/' . $publicUrl;
		}

		$dataAttributes = array_merge(
			[
				'name' => 'lottie' . $instanceType . $file->getUid(),
				'animation-path' => $publicUrl,
				'anim-autoplay' => 'false',
				'anim-loop' => 'true',
				'bm-renderer' => 'svg',
			],
			$options['data'] ?? []
		);
		$lottieTag->addAttribute('data', $dataAttributes);


		// Dispatch signal to enable modifying of data
		// This Signal expects no return value(s) rather than changes made via pass-by-reference
		$this->getSignalSlotDispatcher()->dispatch(
			__CLASS__,
			'manipulateOutputBeforeRender',
			[
				$this,
				$file,
				$width,
				$height,
				$options,
				$usedPathsRelativeToCurrentScript,
				$containerTag,
				$lottieTag,
			]
		);


		$containerTag->setContent(
			$lottieTag->render()
		);
		return $containerTag->render();
	}


	/**
	 * Returns the SignalSlot/Dispatcher instance
	 * @return Dispatcher
	 */
	protected function getSignalSlotDispatcher() {
		return GeneralUtility::makeInstance(Dispatcher::class);
	}
}
