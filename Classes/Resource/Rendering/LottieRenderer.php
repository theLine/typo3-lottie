<?php
namespace TheLine\Lottie\Resource\Rendering;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

class LottieRenderer implements \TYPO3\CMS\Core\Resource\Rendering\FileRendererInterface {

	/**
	 * Returns the priority of the renderer
	 * This way it is possible to define/overrule a renderer
	 * for a specific file type/context.
	 *
	 * For example create a video renderer for a certain storage/driver type.
	 *
	 * Should be between 1 and 100, 100 is more important than 1
	 *
	 * @return int
	 */
	public function getPriority() {
		return 10;
	}

	/**
	 * Check if given File(Reference) can be rendered
	 *
	 * @param FileInterface $file File or FileReference to render
	 * @return bool
	 */
	public function canRender(FileInterface $file) {
		$file = $file instanceof FileReference
			? $file->getOriginalFile()
			: $file
		;
		return (
			$file->getExtension() === 'json'
			&& $file->getProperty('tx_lottie_is_lottie_animation')
		);
	}

	/**
	 * Render for given File(Reference) HTML output
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

		// It may be useful to know if $file was a File or FileReference
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

		// If no valid dimensions were provided, let's try to read the dimensions from the Lottie animation itself
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

		$containerAttributes = [
		];

		$attributes = [
			'data-name' => 'lottie' . $instanceType . $file->getUid(),
			'data-animation-path' => $file->getPublicUrl($usedPathsRelativeToCurrentScript),
			'data-anim-autoplay' => 'false',
			'data-anim-loop' => 'true',
			'data-bm-renderer' => 'svg',
		];

		// If the width and height could be properly determined, add some inline styling
		// to preserve the required space to prevent visual content shifting.
		// This could be rewritten more nicely for TYPO3 CMS v10,
		// but to maintain backwards compatibility just keep it like it is for now.
		if ($width > 0 && $height > 0) {
			$containerAttributes['style'] = sprintf(
				'position:relative;overflow:hidden;padding-top:%g%%',
				($height / $width) * 100
			);
			$attributes['style'] = 'position:absolute;top:0;left:0;width:100%;height:100%';
		}
		// Dispatch signal to enable modifying of attributes
		// This Signal expects no return value(s) rather than changes made via pass-by-reference
		$this->getSignalSlotDispatcher()->dispatch(
			__CLASS__,
			'manipulateAttributesBeforeRender',
			[
				&$attributes,
				$file,
				$this,
			]
		);

		// Make sure that all attributes are properly escaped
		$containerAttributes = static::escapeAttributes($containerAttributes);
		$attributes = static::escapeAttributes($attributes);

		$output = sprintf(
			'<div class="lottie-container" %s><div class="lottie" %s></div></div>',
			implode(' ', $containerAttributes),
			implode(' ', $attributes)
		);
		return $output;
	}

	/**
	 * Returns an array where the given $attribute key/value pairs will be escaped
	 * by using htmlspecialchars and prepared for direct usage in HTML.
	 *
	 * @param  array $attributes
	 * @return array
	 */
	public static function escapeAttributes($attributes) {
		return array_map(
			function ($key, $value) {
				return sprintf('%s=%s', $key, htmlspecialchars($value));
			},
			array_keys($attributes),
			$attributes
		);
	}

	/**
	 * Returns the SignalSlot/Dispatcher instance
	 * @return Dispatcher
	 */
	protected function getSignalSlotDispatcher() {
		return GeneralUtility::makeInstance(Dispatcher::class);
	}

}
