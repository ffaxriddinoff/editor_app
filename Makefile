.DEFAULT_GOAL := help

ADDRESS := $(ADDRESS)
PORT := $(PORT)

.PHONY: prod
prod:
	@composer install --no-dev
	@php artisan optimize
	@php artisan migrate
