<?php

return '#^(?|/dashboard (*:1)|/dashboard/([A-z0-9\\_\\-\\%]+) (*:2)|/dashboard/([A-z0-9\\_\\-\\%]+)/([A-z0-9\\_\\-\\%]+) (*:3)|/ (*:4)|/cache/-([A-z0-9\\_\\-\\%]+)- (*:6)|/cache/([0-9]+)-([A-z0-9\\_\\-\\%]+)- (*:7)|/cache/-([A-z0-9\\_\\-\\%]+)-([A-z0-9\\_\\-\\%]+) (*:8)|/cache/([0-9]+)-([A-z0-9\\_\\-\\%]+)-([A-z0-9\\_\\-\\%]+) (*:9))$#x';