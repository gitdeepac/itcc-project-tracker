# Code Review — TaskController

- SQL injection vulnerability because of the direct query used. Use Eloquent (Safe). Project Id is not sanitised and vulnerable to SQL injection.

- Validation — mass assignment with no validation.

- N+1 query problem — can be achieved through with() eager loading method.

- Separation of logic for autocomplete through Event and Listener.

- Mail function should not be used here — use queues so business logic separation.

- return "ok" instead of proper response string.

- Task::find($id)->delete() — need to check if this id is valid or not before delete else will create an exception, can be solved through findOrFail().