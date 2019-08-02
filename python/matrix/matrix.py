COLUMN_DELIMITER = " "


class Matrix(object):
    def __init__(self, matrix_string):
        self.values = [
                [int(v) for v in row.split(COLUMN_DELIMITER)]
                for row in matrix_string.splitlines()
            ]

    def row(self, index):
        return self.values[index - 1].copy()

    def column(self, index):
        return [row[index - 1] for row in self.values]
