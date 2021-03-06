import json
import mysql.connector
import os
import sys
import unittest
import urllib.request
import urllib.parse

sys.path.append(os.path.dirname(os.path.abspath(__file__)) + '/../../../')
from rest.api import router
from rest.conf import config
from pprint import pprint


class TestSelectAPI(unittest.TestCase):
    # Do a test of Select.

    ID = 0

    def setUp(self):

        # Establish a clean test environment.
        super(TestSelectAPI, self).setUp()

        # Insert test data
        self.create_fixtures()

    def tearDown(self):
        """Clear the test environment"""
        super(TestSelectAPI, self).tearDown()
        self.destroy_fixtures()

    def create_fixtures(self):

        con, cur = self.connect_db()

        global extension_info
        extension_info = {
            'type': 1,
            'dc_id': 'dc_idxxxxxxxx',
            'region_id': 'region_idxxxxxxxxxx',
            'pod_id': 'pod_idxxxxxxxxxx',
            'config_info': '{"aaa":"aaaaaa","bbb":"bbbbbb","ccc":"ccccccc"}',
        }

        # Execute SQL
        param_vals = ['test_create_id-0ac6cb428b23', '2016-12-31 23:59:59',
                      'test_update_id-0ac6cb428b23', '2016-12-31 23:59:59',
                      0,
                      json.dumps(extension_info)]
        cur.execute("INSERT INTO NAL_CONFIG_MNG(" +
                    "create_id, create_date, " +
                    "update_id, update_date, delete_flg, " +
                    "extension_info) VALUES " +
                    "(%s, %s, %s, %s, %s, %s)",
                    param_vals)

        cur.execute('SELECT last_insert_id() FROM NAL_CONFIG_MNG')
        global ID
        ID = cur.fetchall()[0][0]

        self.cut_db(con, cur)

    def destroy_fixtures(self):

        con, cur = self.connect_db()

        # Execute SQL
        param_vals = ['test_create_id-0ac6cb428b23']
        cur.execute("DELETE FROM NAL_CONFIG_MNG WHERE " +
                    "create_id = %s", param_vals)

        self.cut_db(con, cur)

    def connect_db(self):
            # Connect Database
            con = mysql.connector.connect(
                host=getattr(config, 'MYSQL_HOSTNAME', ''),
                db=getattr(config, 'MYSQL_DBNAME', ''),
                user=getattr(config, 'MYSQL_USERID', ''),
                passwd=getattr(config, 'MYSQL_PASSWORD', ''),
                buffered=True)

            # Set Autocommit Off
            con.autocommit = False

            # Open Cursor
            cur = con.cursor()

            return con, cur

    def cut_db(self, con, cur):
        # Commit Transaction
        con.commit()

        # Close Cursor
        cur.close()

        # Close Database
        con.close()

    def test_select_api(self):

        request_params = {
            'query': {
                'delete_flg': '0', 'ID': ID
            },
            'resource': 'nal-configs',
            'method': 'GET',
            'id': []
        }

        res = router.Router().routing(request_params)

        status = res['status']
        res_data = res['message'].decode('utf-8')
        res_data = json.loads(res_data)

        # Assertion
        self.assertEqual(status, '200 OK')
        self.assertEqual(len(res_data), 1)
        self.assertEqual(res_data[0]['ID'], ID)
        self.assertEqual(res_data[0]['create_id'],
                         'test_create_id-0ac6cb428b23')
        self.assertEqual(res_data[0]['update_id'],
                         'test_update_id-0ac6cb428b23')
        self.assertEqual(res_data[0]['delete_flg'], '0')
        self.assertEqual(res_data[0].get('extension_info', ''), '')

        for key in extension_info:
            self.assertEqual(res_data[0].get(key), extension_info[key])

    def test_insert_api(self):

        insert_params = {
            'create_id': 'test_create_id-0ac6cb428b23',
            'update_id': 'test_update_id-0ac6cb428b23',
            'delete_flg': 0,
            'type': 1,
            'dc_id': 'dc_01',
            'region_id': 'region_id_0001',
            'pod_id': 'pod_id_0001',
            'config_info': '{"xxx":"xxxxx","bbb":"bbbbbb","ccc":"ccccccc"}',
        }
        request_params = {
            'body': insert_params,
            'query': {},
            'resource': 'nal-configs',
            'method': 'POST',
            'id': []
        }

        res = router.Router().routing(request_params)
        status = res['status']
        res_data = res['message'].decode('utf-8')
        res_data = json.loads(res_data)

        # Assertion
        self.assertEqual(status, '200 OK')
        self.assertEqual(len(res_data), 1)
        self.assertTrue('ID' in res_data)

        # Assertion(check select)
        request_params = {
            'query': {
                'type': 1,
                'dc_id': 'dc_01',
                'region_id': 'region_id_0001',
                'pod_id': 'pod_id_0001',
            },
            'resource': 'nal-configs',
            'method': 'GET',
            'id': []
        }
        res = router.Router().routing(request_params)
        status = res['status']
        res_data = res['message'].decode('utf-8')
        res_data = json.loads(res_data)

        self.assertEqual(status, '200 OK')
        self.assertEqual(len(res_data), 1)

        for key in insert_params:
            if key == 'delete_flg':
                self.assertEqual(res_data[0].get(key), str(insert_params[key]))
            else:
                self.assertEqual(res_data[0].get(key), insert_params[key])

    def test_update_api(self):

        update_params = {
            'update_id': 'test_update_id-0ac6cb428b23',
            'type': 3,
            'dc_id': 'dc_05',
            'region_id': 'region_id_0007',
            'pod_id': 'pod_id_0007',
            'config_info': '{"vvv":"vvvvvv","bbb":"bbbbbb","ccc":"ccccccc"}',
        }
        request_params = {
            'body': update_params,
            'query': {},
            'resource': 'nal-configs',
            'method': 'PUT',
            'id': [ID]
        }

        res = router.Router().routing(request_params)
        status = res['status']
        res_data = res['message'].decode('utf-8')
        res_data = json.loads(res_data)

        # Assertion
        self.assertEqual(status, '200 OK')
        self.assertEqual(res_data, True)

        # Assertion(check select)
        request_params = {
            'query': {
                'type': 3,
                'dc_id': 'dc_05',
                'region_id': 'region_id_0007',
                'pod_id': 'pod_id_0007',
            },
            'resource': 'nal-configs',
            'method': 'GET',
            'id': []
        }
        res = router.Router().routing(request_params)
        status = res['status']
        res_data = res['message'].decode('utf-8')
        res_data = json.loads(res_data)

        self.assertEqual(status, '200 OK')
        self.assertEqual(len(res_data), 1)

        for key in update_params:
            if key == 'delete_flg':
                self.assertEqual(res_data[0].get(key), str(update_params[key]))
            else:
                self.assertEqual(res_data[0].get(key), update_params[key])

    def test_delete_api(self):

        request_params = {
            'body': {},
            'query': {},
            'resource': 'nal-configs',
            'method': 'DELETE',
            'id': [ID]
        }

        res = router.Router().routing(request_params)
        status = res['status']
        res_data = res['message'].decode('utf-8')
        res_data = json.loads(res_data)

        # Assertion
        self.assertEqual(status, '200 OK')
        self.assertEqual(res_data, True)

        con, cur = self.connect_db()

        cur.execute("SELECT ID FROM NAL_CONFIG_MNG " +
                    "WHERE ID = %s", [ID])

        self.assertEqual(cur.fetchall(), [])

        self.cut_db(con, cur)
