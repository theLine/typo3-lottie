<?php
namespace TheLine\Lottie\Resource\Rendering;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileReference;

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

		// @TODO: Try to read the width/height and set it accordingly to prevent jumping of content
		// $styles = [];
		// if ($width) {
		// 	$styles[] = 'width:'. (int)$width .'px';
		// }
		// if ($height) {
		// 	$styles[] = 'height:'. (int)$height .'px';
		// }

		$attributes = [
			// 'style' => implode(';', $styles),
			'data-name' => 'lottie' . $instanceType . $file->getUid(),
			'data-animation-path' => $file->getPublicUrl($usedPathsRelativeToCurrentScript),
			'data-anim-autoplay' => 'false',
			'data-anim-loop' => 'true',
			'data-bm-renderer' => 'svg',
		];

		// Make sure that all attributes are properly escaped
		$attributes = implode(' ', array_map(
			function ($key, $value) {
				return $key .'="'. htmlspecialchars($value) .'"';
			},
			array_keys($attributes), $attributes
		));

		$output = '<div class="lottie" '. $attributes .'></div>';
		return $output;
	}
}
