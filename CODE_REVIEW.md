# Code Review — TaskController


## High - No commit (block and send back to review and update the code)

- SQL injection vulnerability because of the direct query used. Use Eloquent (Safe). Project Id is not sanitised and vulnerable to SQL injection.
- Task::find($id)->delete() — need to check if this id is valid or not before delete else will create an exception, can be solved through findOrFail().
- Validation — mass assignment with no validation.

## Medium - Can be fixed in next iteration

- N+1 query problem — can be achieved through with() eager loading method.
- Separation of logic for autocomplete through Event and Listener.
- Mail function should not be used here — use queues so business logic separation.

## Low - Lets slide this

- return "ok" instead of proper response string.

