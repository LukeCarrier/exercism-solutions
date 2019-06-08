ROW_DELIMITER = "\n"
COLUMN_DELIMITER = " "


class Matrix(object):
    def __init__(self, matrix_string):
        self.values = []
        for row in matrix_string.split(ROW_DELIMITER):
            self.values.append([int(v) for v in row.split(COLUMN_DELIMITER)])

    def row(self, index):
        return self.values[index - 1]

    def column(self, index):
        return [row[index - 1] for row in self.values]
