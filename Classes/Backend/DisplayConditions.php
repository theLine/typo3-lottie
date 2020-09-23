<?php
namespace TheLine\Lottie\Backend;

use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;

class DisplayConditions {

	/** @var FileRepository $fileRepository */
	protected $fileRepository;

	/**
	 * @param FileRepository $fileRepository
	 */
	public function injectFileRepository (FileRepository $fileRepository) {
		$this->fileRepository = $fileRepository;
	}

	/**
	 * Returns true if the given File's extension is 'json'.
	 * The File's uid must be passed as `$parameters['record']['uid']`.
	 *
	 * @param array $parameters
	 * @return bool
	 * @throws \InvalidArgumentException
	 */
	public function checkIfIsJsonFile(array $parameters): bool {
		// If the record's uid is not nor an interger return false
		if (! isset($parameters['record']['file'][0])
			|| ! MathUtility::canBeInterpretedAsInteger($parameters['record']['file'][0])
		) {
			return false;
		}

		// Find the File by the given uid …
		$file = $this->getFileRepository()->findByUid($parameters['record']['file'][0]);
		if ($file instanceof FileInterface) {
			// … and return true, if the File's extension is 'json';
			return $file->getExtension() === 'json';
		}

		// We can be sure that the given file is not a JSON file, thus return false
		return false;
	}

	/**
	 * @return FileRepository
	 */
	protected function getFileRepository(): FileRepository {
		if (! $this->fileRepository instanceof FileRepository) {
			$this->fileRepository = GeneralUtility::makeInstance(FileRepository::class);
		}
		return $this->fileRepository;
	}
}
