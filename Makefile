PHP_TAG_IMAGE_BASE="8.0.13"
NGINX_TAG_IMAGE_DEV="1.19.7-alpine-2"
NODE_TAG_IMAGE_BASE="17.0.0"
CYPRESS_TAG_IMAGE_BASE="8.5.0"
DOC_TAG_IMAGE="staging"
PLACEHOLDER_DEV_NONCE_CSP=AABBCCDD

comma := ,

define head-title
   echo "\n  "${boldunderline}${1}${normal}${2}
endef

define head-row
   echo "\t"${1}""
endef

define head-list
   echo "\t"${bold}${1}${normal}" - "${2}
   echo ${3}
endef

quickstart: header
	$(call head-row,"... happy coding","\n")
	$(call head-title,"USAGE","\n")

	$(call head-title,"make COMMAND")
	$(call head-row,"Setup the full environment with:")

	$(call head-title,"make setup")
	$(call head-row,"Get an interactive shell (inside the PHP container) with:")

	$(call head-title,"make shell")
	$(call head-row,"To get help and the full list of commands:")

	$(call head-title,"make help")
	$(call head-row,"To get help and the full list of commands:")

help: quickstart
	@make help-composer
	@make help-db
	@make help-docker
	@make help-helm
	@make help-legacy
	@make help-quality
	@make help-symfony
	@make help-test
	@make help-frontend
	@make help-utils
	@make help-workflow
	@echo ""

start: test-up-mock
	running=$$(docker-compose ps php | grep -c "Up"); \
	if [ "$$running" -eq 0 ]; then \
		docker-compose up -d --quiet-pull nginx nginx-admin; \
	fi;

shell: start
	@docker-compose exec php zsh

setup: start legacy-start composer-install db-setup setup-fe setup-admin

stop: legacy-stop
	@docker-compose stop

down: stop
	@docker-compose -f docker-compose.mocks.yml down
	@docker-compose -f docker-compose.legacy.yml down
	@docker-compose down

ps:
	@docker-compose -f docker-compose.legacy.yml ps
	@docker-compose -f docker-compose.mocks.yml ps
	@docker-compose ps

build-csp:
	$(call head-title,"BUILDING CSP START","\n")
	@docker-compose exec -T php bin/console pagamenti:csp:builder --env=test
	$(call head-title,"BUILDING CSP COMPLETED","\n")

puntamenti-siti:
	$(call head-title,"PUNTAMENTI FRONTEND","\n")
	$(call head-row,"https://pagamenti.dev-facile.it")
	$(call head-row,"https://pagamenti-build.dev-facile.it")

	$(call head-title,"PUNTAMENTI ADMIN","\n")
	$(call head-row,"https://pagamenti-admin.dev-facile.it")
	$(call head-row,"https://pagamenti-admin-build.dev-facile.it")

include makefiles/composer.mk
include makefiles/database.mk
include makefiles/docker.mk
include makefiles/helm.mk
include makefiles/legacy.mk
include makefiles/quality.mk
include makefiles/symfony.mk
include makefiles/test.mk
include makefiles/utils.mk
include makefiles/workflow.mk
include makefiles/queue.mk
include frontend/makefiles/frontend.mk
include admin/makefiles/admin.mk

### UTILS

header:

	@echo ""
	@echo "${bold}Welcome to Pagamenti II "
	@echo "                                                  __  _ "
	@echo "    ____  ____ _____ _____ _____  ___   ___ ____ / / (_)"
	@echo "   / __ \/ __ / __ / __ / __ __ \/ _ \/ __ \/ __/ / / /"
	@echo "  / /_/ / /_/ / /_/ / /_/ / / / / / /  __/ / / / /_/ / "
	@echo " / .___/\__,_/\__, /\__,_/_/ /_/ /_/\___/_/ /_/\__/_/  "
	@echo "/_/          /____/                                    "
	@echo "${normal}"


bold := "\\033[1m"
normal := "\\033[0m"
boldunderline := "\\033[1m\\033[4m"
titlebg := "\\e[41m\\e[97m"


.SILENT:
