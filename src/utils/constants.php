<?php

namespace constants;

const REG_FOR_NAME     = '/[a-z-. а-яё]+/';
const REG_FOR_EMAIL = '/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
const REG_FOR_SYMBOLS  = '/[_~!@#$%^&*()\[\]+`\'";:<>\/\\|=]/';
const REG_FOR_PASSWORD = '/[0-9a-z-а-яё]+/';