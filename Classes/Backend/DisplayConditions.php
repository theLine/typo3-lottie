<?php

/*
 * This file is part of the "lottie" Extension for TYPO3 CMS.
 * For the full copyright and license information, please read the LICENSE file
 * that was distributed with this source code.
 * (c) 2019-2022
 */

namespace TheLine\Lottie\Backend;

use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;

class DisplayConditions {

	/** @var FileRepository $fileRepository */
	protected $fileRepository;

	public function injectFileRepository(FileRepository $fileRepository): void {
		$this->fileRepository = $fileRepository;
	}

	/**
	 * Returns true if the given File's extension is 'json'.
	 *
	 * @throws \InvalidArgumentException
	 */
	public function checkIfIsJsonFile(array $parameters): bool {

		// This record will be `sys_file_metadata` and not `sys_file`!
		$record = &$parameters['record'];

		// If the sys_file's uid is not present there must be something terribly wrong!
		// But for now just return false.
		if (! isset($record['file'][0])) {
			return false;
		}

		// If the sys_file's uid is not an integer return false as well
		if (! MathUtility::canBeInterpretedAsInteger($record['file'][0])) {
			return false;
		}

		// Find the File object by the given uid …
		$file = $this->getFileRepository()->findByUid($record['file'][0]);
		if ($file instanceof FileInterface) {
			// … and return true, if the File's extension is 'json'.
			return $file->getExtension() === 'json';
		}

		// At this point we can be sure that the given file is not a JSON file, thus return false.
		return false;
	}

	protected function getFileRepository(): FileRepository {
		if (! $this->fileRepository instanceof FileRepository) {
			$this->fileRepository = GeneralUtility::makeInstance(FileRepository::class);
		}

		return $this->fileRepository;
	}
}
