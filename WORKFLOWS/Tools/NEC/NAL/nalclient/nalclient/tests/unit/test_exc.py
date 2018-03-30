#  Licensed under the Apache License, Version 2.0 (the "License"); you may
#  not use this file except in compliance with the License. You may obtain
#  a copy of the License at
#  
#       http://www.apache.org/licenses/LICENSE-2.0
#  
#  Unless required by applicable law or agreed to in writing, software
#  distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
#  WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
#  License for the specific language governing permissions and limitations
#  under the License.
#  
#  COPYRIGHT  (C)  NEC  CORPORATION  2017
#  


import testtools

from nalclient import exc


class TestHTTPExceptions(testtools.TestCase):

    def test_nal_response(self):
        """exc.from_response should return instance of an HTTP exception."""
        result = {
            "error-code": "NAL110001",
            "message": "",
            "status": "success"
        }
        out = exc.nal_response(result)
        self.assertIsInstance(out, exc.NalBadRequest)