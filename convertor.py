#!/usr/bin/env python
# -*- coding: utf-8 -*-
from __future__ import print_function
import sys
reload(sys)
sys.setdefaultencoding("utf-8")

from nbconvert.exporters import HTMLExporter
from traitlets.config import Config

config = Config({
    "HTMLExporter": {"template_file": "basic"},
    'NbConvertBase': {
        'display_data_priority': [
            'text/html',
            'text/markdown',
            'application/pdf',
            'image/svg+xml',
            'text/latex',
            'image/png',
            'image/jpeg',
            'text/plain',
        ]
    }
})
ex = HTMLExporter(config=config)

html, extra = ex.from_file(sys.stdin)
sys.stdout.write(html)
