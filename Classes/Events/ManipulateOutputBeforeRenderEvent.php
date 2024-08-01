<?php

declare(strict_types=1);

/*
 * This file is part of the "lottie" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the LICENSE file
 * that was distributed with this source code.
 * (c) 2019-2024
 */

namespace TheLine\Lottie\Events;

use TheLine\Lottie\Resource\Rendering\LottieRenderer;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder;

final class ManipulateOutputBeforeRenderEvent
{
    /**
     * @var LottieRenderer
     */
    private $lottieRenderer;
    /**
     * @var FileInterface
     */
    private $file;
    /**
     * @var int|string
     */
    private $width;
    /**
     * @var int|string
     */
    private $height;
    /**
     * @var array
     */
    private $options;
    /**
     * @var bool
     */
    private $usedPathsRelativeToCurrentScript;
    /**
     * @var TagBuilder
     */
    private $containerTag;
    /**
     * @var TagBuilder
     */
    private $lottieTag;

    /**
     * @param LottieRenderer $lottieRenderer
     * @param FileInterface $file
     * @param int|string $width
     * @param int|string $height
     * @param array $options
     * @param bool $usedPathsRelativeToCurrentScript
     * @param TagBuilder $containerTag
     * @param TagBuilder $lottieTag
     */
    public function __construct(
        LottieRenderer $lottieRenderer,
        FileInterface $file,
        $width,
        $height,
        array $options,
        bool $usedPathsRelativeToCurrentScript,
        TagBuilder $containerTag,
        TagBuilder $lottieTag
    ) {
        $this->lottieRenderer = $lottieRenderer;
        $this->file = $file;
        $this->width = $width;
        $this->height = $height;
        $this->options = $options;
        $this->usedPathsRelativeToCurrentScript = $usedPathsRelativeToCurrentScript;
        $this->containerTag = $containerTag;
        $this->lottieTag = $lottieTag;
    }

    /**
     * @return LottieRenderer
     */
    public function getLottieRenderer(): LottieRenderer
    {
        return $this->lottieRenderer;
    }

    /**
     * @return FileInterface
     */
    public function getFile(): FileInterface
    {
        return $this->file;
    }

    /**
     * @return int|string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int|string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @return bool
     */
    public function isUsedPathsRelativeToCurrentScript(): bool
    {
        return $this->usedPathsRelativeToCurrentScript;
    }

    /**
     * @return TagBuilder
     */
    public function getContainerTag(): TagBuilder
    {
        return $this->containerTag;
    }

    /**
     * @return TagBuilder
     */
    public function getLottieTag(): TagBuilder
    {
        return $this->lottieTag;
    }

    /**
     * @param TagBuilder $containerTag
     */
    public function setContainerTag(TagBuilder $containerTag): void
    {
        $this->containerTag = $containerTag;
    }

    /**
     * @param TagBuilder $lottieTag
     */
    public function setLottieTag(TagBuilder $lottieTag): void
    {
        $this->lottieTag = $lottieTag;
    }
}
