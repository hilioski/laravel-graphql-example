# GraphQL Example

You have to make a GraphQL API that would work for the following queries (with GraphQL):

```
query {
    movies {
        name,
        year,
        description,
        actors {
            name
        }
    }
}
```

```
query {
    movie($name) {
        year,
        description,
        actors {
            name
        }
    }
}
```

```
query {
    actors {
        name,
        movies {
            name
        }
    }
}
```

```
query {
    actor($name) {
        movies {
            name
        }
    }
}
```

BONUS POINTS:  
make a MUTATION based login system for the following mutation (design it yourself)

```
mutation {
    login($email: "email@example.com", $password: "password") {
        token,
        name,
        city,
        phone
    }
}
```

## ALTERNATIVELY:

Same exact API, but REST

## REST API ENDPOINTS
- Login `/api/auth/login`
- Movies `/api/movies` (* possible query parameters are `fields`, `include`... see more at https://github.com/spatie/laravel-query-builder)
- Actors `/api/actors` (* possible query parameters are `fields`, `include`... see more at https://github.com/spatie/laravel-query-builder)

________________________
## USED PACKAGES:
- [spatie/laravel-query-builder] https://github.com/spatie/laravel-query-builder
- [nuwave/lighthouse] https://github.com/nuwave/lighthouse
