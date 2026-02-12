# Why use Resources?

The Resources pattern provides an additional layer in a modular MVC architecture that helps standardize and protect the data returned by your API. But why is this a good practice?

Resources act as a translation layer between your Eloquent models and the JSON responses sent to the frontend. They allow you to:

- Control which fields are exposed to clients.
- Rename or transform attributes without changing the underlying database schema.
- Add computed or related attributes in a consistent and reusable way.

For example, if a column name changes in the database, you can update the Resource to keep the API response stable for frontend consumers instead of modifying every client or controller that consumes the API.

Using Resources centralizes response formatting, reduces duplication across controllers, and makes it safer and easier to evolve the API over time.