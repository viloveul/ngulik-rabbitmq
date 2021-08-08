<?php

require_once __DIR__ . '/vendor/autoload.php';

$bus = new Viloveul\Transport\Bus();
$bus->initialize();
$bus->addConnection('amqp://localhost:5672//');

class TaskPassenger extends Viloveul\Transport\Passenger
{
	protected $type = 'direct';

	public function point(): string
	{
		return 'celery';
	}

	public function route(): string
	{
		return 'celery';
	}

	public function data(): string
	{
		return json_encode([
			'id' => uniqid(),
			'task' => 'viloveul',
			'kwargs' => $this->getAttributes()
		]);
	}

	public function handle(): void
	{
		$this->setAttribute('foo', 'Testing');
		$this->setAttribute('bar', 'Berhasil');
	}
}

$bus->process(new TaskPassenger);