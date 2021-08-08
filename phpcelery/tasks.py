from celery import Celery

app = Celery('tasks', broker='pyamqp://guest@localhost//')

@app.task(name = 'viloveul')
def add(foo, bar):
	print("ini adalah {0} dan {1}".format(foo, bar))