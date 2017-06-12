<?php

use Nette\CodeChecker\Tasks;
use Nette\CodeChecker\Result;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';


test(function () {
	$result = new Result;
	Tasks::utf8Checker("\xc5\xbelu\xc5\xa5ou\xc4\x8dk\xc3\xbd", $result); // UTF-8   žluťoučký
	Assert::same([], $result->getMessages());
});

test(function () {
	$result = new Result;
	Tasks::utf8Checker("\xFF", $result);
	Assert::same([[Result::ERROR, 'Is not valid UTF-8 file', NULL]], $result->getMessages());
});
