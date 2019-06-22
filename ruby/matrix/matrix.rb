class Matrix
  attr_reader :rows, :columns

  def initialize(matrix)
    @matrix = matrix
  end

  def rows
    @rows ||= @matrix.lines.map { |row| row.split.map(&:to_i) }
  end

  def columns
    rows.transpose
  end
end
