class Matrix
  ROW_DELIMITER = "\n"
  COLUMN_DELIMITER = " "

  attr_reader :rows, :columns

  def initialize(matrix)
    @values = []
    matrix.split(ROW_DELIMITER).each do |row|
      @values.append(row.split(COLUMN_DELIMITER).map { |v| v.to_i })
    end
  end

  def rows
    @values
  end

  def columns
    @values.transpose
  end
end
