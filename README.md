
## Installation

- To build the project `docker-compose build`
- To run the project `docker-compose up -d`
- Then `docker exec sms_gateway_php dockerfiles/bin/prj-build.sh` to install and run basic items.
- **Note**: if you made any change in config or files, you need to reset supervisor with command below:
  - Run `docker exec -it sms_gateway_php supervisorctl restart all`

## Usage
- to see the website: http://localhost:82
  - The project has LOGIN panel and another feature as authentication system.
  - Authentication info:
    - email: `admin@email.com`
    - password: `password`
- To see the **Horizon** dashboard (to manage queues) http://localhost:82/horizon
- The API webservice sample exists in root of the project (SMSGateway.postman_collection.json)
  - There is no authentication in REST API and all routes work without it.
