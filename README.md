# ApplicationUserBundle for Sulu CMS

## Usage
Add router configuration:
```
application_user:
    resource: "@ApplicationUserBundle/Resources/config/routing_api.yml"
    type: rest
    prefix: /admin/api
```

Add to the Kernel:
```
new Savwy\SuluBundle\ApplicationUserBundle\ApplicationUserBundle(),
```
